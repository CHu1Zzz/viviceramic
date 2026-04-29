@echo off
chcp 65001 >nul
cd /d "%~dp0"
set "PORT=8765"
echo Starting ViviCeramics local server...
echo Open http://127.0.0.1:%PORT%/ in your browser
py -3 -m http.server %PORT% --bind 127.0.0.1
