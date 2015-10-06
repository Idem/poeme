poeme
=====

[![Build Status](https://travis-ci.org/Idem/poeme.svg?branch=master)](https://travis-ci.org/Idem/poeme)
[![Code Climate](https://codeclimate.com/github/Idem/poeme/badges/gpa.svg)](https://codeclimate.com/github/Idem/poeme)

Poeme displays an set of images stored in a folder within a loop.


You can easily configure where to find images and how to handle them:
* Images can be displayed in a fixed or random order.
* Display time per image
test_config.ini files is used if present. If not, config.ini is.

Example ini file:
```
[verse1]                    ; Container ID
path = "./tests/verse1"     ; relative path to the folder containing the images
refresh = 3                 ; display time per images
random = true               ; use either random or alphabetical order to display images.

[verse2]
path = "./tests/verse2"
refresh = 5
```

Using non random order allow one to display the same image at the same time for all clients.
