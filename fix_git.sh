#!/bin/bash
sed -i '' 's|^/process/|#/process/|g' .gitignore
cat << 'IGN' >> .gitignore

# 재귀적 무시 및 예외 처리
/process/*
!/process/ethics/
/process/ethics/*
!/process/ethics/11/
/process/ethics/11/**
!/process/ethics/11/**/
!/process/ethics/11/**/*.html
!/process/ethics/11/**/*.js
IGN
