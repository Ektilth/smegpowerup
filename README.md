# SMEG Powerup!

This code is only a frontend + backend that somehow happens to work with the PSAKey project, created by https://github.com/Mwyann/psakey

Currently working:
- Screen Mirroring (not fast, currently 1.5-3.3 FPS (2.2 on average), depending on the content of the image and the background refresh of the other images)
- Adblue level display (only displaying, new fills currently need to be uploaded by hand with RESTer, for example)
- Debug screen (most of the SMEG's internal API is listed there)

TODO:
- Make screen mirroring faster
- Adblue fill upload on the currently broken adblue-fill.html
- Configuration screen (currently empty)
- Wifi reconnect on button click (because the RPI does not do this by itself)
- General code cleanup because it's a mess.

Any pull request, issue or comment is welcome!

Special thanks to @Mwyann for his awesome work, support and for the frontend + backend code snippets I used for this project.