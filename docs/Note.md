### Current flow submit artwork

When a user submit an artwork, the artwork file will be save in table artwork_version, image and preview 
image will be save in table artwork.

Artwork version will be save information upload file of artwork.(field artwork_file), for example to get
artwork file of artwork id=143

``` 
SELECT artwork_file FROM `artwork_version` WHERE artwork_id=143 
return 3322
```
To get artwork file form aws s3 you need query form table downloadable_contents.

``` 
SELECT * FROM `downloadable_contents` WHERE id=3322 
```


### Note chat from slack

https://www.dropbox.com/s/6mbv4s0wz0jlhwz/FRAMED_ARTISTGUIDE.pdf?dl=0

the flowchart @filip provided above is currently done manually.  not done by ArtworkPackager.php (edited) 
an artwork may contains folders and multiple files, that's the reason that we require the artist to put the files of an artwork into a zip file
a video artwork can consist of multiple video files, too.  the videos will be played in a random sequence one by one

ArtworkPackager.php does the following:
- unzip the zip file
- apply the DRM encryption to each of the files in the zip
- zip the files into a zip file (edited) 
i just took a quick look of the code.  not sure if i missed anything important
an artwork can have a published version and several draft versions