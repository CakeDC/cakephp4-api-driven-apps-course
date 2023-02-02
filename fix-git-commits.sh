#!/usr/bin/env bash

if [ -z "$1" ]; then
  read -p "Enter git hash: " hash
else
  hash=$1
fi

if ! [[ "$hash" =~ ^[a-zA-Z0-9]{40}$ ]]; then
  echo "Invalid hash. Please enter a valid 40-character git commit SHA." >&2
  exit 1
fi

GIT_COMMITTER_NAME="Jamison Bryant";
GIT_COMMITTER_EMAIL="jamison@bryant.ai";
export GIT_COMMITTER_NAME;
export GIT_COMMITTER_EMAIL;

git rebase --no-ff $hash
