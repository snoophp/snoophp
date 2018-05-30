#!/bin/sh

#----------------------------------------
# Variables

DATE=$(date +%Y-%m-%dT%H:%M:%S)
LOG_ID=$1
LOG_EXT=".log"
LOG_DIR="$(dirname $0)/logs/webhook"
LOG_FILE="$LOG_DIR/$LOG_ID$LOG_EXT"

#----------------------------------------
# Functions

# Exit and write to log file
#
# $1	error message
err () {

	if [ -d "$LOG_DIR" ]; then
		echo "err: $1" >> $LOG_FILE
	else
		echo "$1" >&2
	fi

	# Exit script
	exit 1
}

# Write to to log file
#
# $1	log content
log () {

	if [ -d "$LOG_DIR" ]; then
		echo "$1" >> $LOG_FILE
	else
		echo "$1"
	fi
}

# Reset repo to last commit
# Also deletes redundant files
#
# $1	active branch
sync () {

	branch="$1"

	# Run git
	git fetch origin
	status=$(git reset --hard "origin/$branch") \
	|| err "could not reset origin/$branch"
	log "$status"

	# Clean redundant files and directories
	git clean -df
	log "cleaning project ..."
}

# Create log directory if doesn't exist
create_log_dir () {

	if [ ! -d "$LOG_DIR" ]; then
		echo "creating log directory at $LOG_DIR"
		mkdir -p "$LOG_DIR"
	fi
}

#----------------------------------------
# Run

echo "starting script ..."

# Create log dir if doesn't exist
create_log_dir

# Set log filename
: "${LOG_ID:=$DATE}"

log "------------------------------"
log "id:   $LOG_ID"
log "time: $DATE"
log "------------------------------"

log "\n"

# Sync repo to last commit
sync "$2"

log "\n"

# Print current work dir
log "=============================="
log "Working directory:"
log $(ls -l)

echo "completed!"