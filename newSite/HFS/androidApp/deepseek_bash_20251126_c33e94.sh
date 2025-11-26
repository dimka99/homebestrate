#!/bin/bash
echo "Building Mortgage Rate Hub APK..."

# Clean project
./gradlew clean

# Build release APK
./gradlew assembleRelease

echo "APK built successfully!"
echo "Location: app/build/outputs/apk/release/app-release.apk"