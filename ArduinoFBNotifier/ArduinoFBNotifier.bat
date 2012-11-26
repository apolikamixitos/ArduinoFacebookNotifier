::Proxy to communicate between the device and "FBSerialCom.php" script
cd tools/serialcom
start "Arduino PHP Proxy" serproxy.exe

cd ../php
start "Facebook Checker" php.exe ../../script/FBChecker.php