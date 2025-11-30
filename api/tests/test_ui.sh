#!/bin/bash
set -e

STATUS=$(curl -o /dev/null -s -w "%{http_code}" http://localhost/index.php)

if [ "$STATUS" != "200" ]; then
  echo "FAIL: UI no cargada, status code $STATUS"
  exit 1
fi

echo "OK: UI Cargada correctamente"