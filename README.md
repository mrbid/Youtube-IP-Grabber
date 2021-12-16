# Youtube IP Grabber
A javascript "IP Grabber" that disguises itself behind YouTube metadata.

![view.php](https://raw.githubusercontent.com/mrbid/Youtube-IP-Grabber/main/screenshot1.png)

## About

This is a simple to setup IP logger that is capable of detecting a user's true country of origin even while behind a VPN, in most cases. No external dependencies are required other than NGINX and PHP-FPM.

**Server Dependencies:** NGINX, PHP-FPM<br>
**Client Dependencies:** HTML, CSS, Javascript

## Instructions

Copy the contents of this git to your root `www` directory and setup permissions so that the PHP files can create new files within that directory. *(it's going to generate log files as plain text)*

Create a URL to point at this `www`, for example, `logtu.be`.

**To create a logging URL:** *(will use the original YouTube video metadata and redirect to the original video when clicked)*<br>
https://logtu.be/?v=_<YOUTUBE-VIDEO-ID\>_

A URL will be generated and provided as the body of the request-response (HTML page). This is the URL that you distribute to users you intend to grab the IP address of. It will look like;<br>
https://logtu.be/_<YOUTUBE-VIDEO-ID\>_

**To view the list of users who clicked the URL:**<br>
https://logtu.be/_<YOUTUBE-VIDEO-ID\>_[/view.php]()

**To view the clicks of all URLs:**<br>
https://logtu.be/master/view.php

There are other logs produced, just explore the `www` directory to see what is generated. The only other log worth mentioning right now is the prelog.txt which is a log of all users whom clicked a URL - this is helpful in cases where some users failed to load the Javascript payload either due to NoScript or closing the page instantly after clicking.

Timestamps are baked into the User Agent (UA) string.

## Improvements
I could encrypt or at the very least base64 the url parameters being sent to the server from the Javascript payload, but I don't. It's not a big deal as it does not reduce the effectiveness of the vector but does allow external parties performing an investigation to identify the kind of information being logged if so desired.

## Ethos

This is a simple and lightweight utility, designed to log and view a few thousand IP addresses at maximum. `view.php` is not designed to load millions of IP addresses and simple file-based logs in this manner will reach a 4GB limit on FAT32 without forking to historical log files. This was designed with the intention that no logging URL would be used for more than a few thousand clicks.

The problem when IP logging is that unless you send a specific user a logging link in private, it can be hard to know who exactly clicked and what any of that means to you as the logger. This is why I designed the user interface `view.php` with emphasis on this fact to ensure it loaded relevant statistics about a clicking user in a way that is easy on the eye, all fitting on-screen elegantly and concisely with relevant tooltips. Once data is presented in such a manner, it can be easier to visually infer correlations in the data which can help identify the original clicker. For example, in the user agent (UA) the mobile or desktop device and browser used will be listed, and the panel will list the phone technical specifications such as memory, CPU count, GPU type, etc, and connection information such as how the user is connecting to the internet be it via WIFI or Cellular. These kinds of details can help you identify the original clicker by asking a few suggestive questions in public chats or directly to users you suspect the clicker to be. Also considering that you are proving links to videos, this alone can infer a lot about a user's interests or viewing preferences over time.

This is a tool I originally made back around 2019 for my digital advertising business [VOXDSP](https://james-william-fletcher.medium.com/why-the-openrtb-protocol-is-a-failure-b65f173ed410), to identify fraudulent or bot traffic from traffic suppliers, however, I recently decided to adapt it for a more general-purpose that common internet users would be more likely to find of use. I believe that when dealing with large amounts of non-descript information such as pseudo-anonymous IP logs, how you present that data is key, alongside what data you can collect, and most of that data the user's web browser will tell you freely upon executing custom javascript code.

## Why do your screenshots have a dark UI?
I am using Dark Reader, https://darkreader.org/.

## MIT License

Copyright (c) 2021 VOXDSP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

