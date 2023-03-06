# SMEG Powerup!

This code is only a frontend + backend that somehow happens to work with the PSAKey project, created by https://github.com/Mwyann/psakey

Currently working:
- Screen Mirroring (not fast, currently 1.5-3.3 FPS (2.2 on average), depending on the content of the image and the background refresh of the other images)
- Adblue level display and uploading new fills
- Debug screen (most of the SMEG's internal API is listed there)

How to install:
- Install psakey (tutorial in the original repo)
- Install and enable php7.3 and php7.3-gd (gd is only needed for mirroring, everything else works without it)
- Clone the repo and copy the files into the /var/www/psakey folder
- If you want to use the screen mirroring feature, install Screen Stream over HTTP to your phone: https://play.google.com/store/apps/details?id=info.dvkr.screenstream
- Configure the RPI to connect to your phone's wifi hotspot
- Reboot the RPI and check if it connects to the phone. After connection, enable screen stream in the app. If the image is cut in the wrong place, adjust it in the mirror.php file.

TODO:
- Make screen mirroring faster
- List from the past adblue fills
- Configuration screen (currently empty, screen mirroring config would be way more convenient from the car)
- Wifi reconnect on button click (because the RPI does not do this by itself)
- General code cleanup because it's a mess.

Any pull request, issue or comment is welcome!

Special thanks to @Mwyann for his awesome work, support and for the frontend + backend code snippets I used for this project.