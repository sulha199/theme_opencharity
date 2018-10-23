# Drupal 7 Theme for Open Charity

This theme is build based on basic javascript and css. The css is generated using css predecessor, it is compiled using compass. Below is the preview:
![Site screenshot](https://github.com/sulha199/theme_opencharity/raw/master/screenshot.png)

## Getting Started
Please follow instruction on how to install theme in Drupal 7

## Regions
![region demonstration](https://github.com/sulha199/theme_opencharity/raw/master/block-simulation.JPG)
The regions in this theme are :
1. Navigation : top right of the page
2. Header : before the content, full width
3. After Header: colored background
4. Before Content: white background
5. Content: white background
6. Right Sidebar
7. After Content: colored background
8. Before footer: white background
9. Footer

## Slider
Slider is used to create a responsive content-slider in members and blog block. To use the slider just add the following classes
```
<div .. class="flex-slider flex-width-200 ...">
```
The class width 200 is to set the min-width to be 200px, hence if you want to set the min-width to 300 then write the class as follows:
```
<div .. class="flex-slider flex-width-300  ...">
```

By default, the slider will have bullet button below the content as the slider pagination.  
You can also change the slider style to use previous/next button on the side of the content by using the flex-sidebutton class as follows:
```
<div .. class="flex-slider flex-width-300 flex-sidebutton ...">
```

## Open Charity Page
### Home Banner Block
The home banner uses view-home-banner as the classname. The image and text is generated from a basic page so it can be modified by modifying the related page.
```
<div .. class="view-home-banner ...">
```

### Get Involved, Our Mission, and Members Block
It use view-get-involved, view-mission, view-members as the classname respectively. The image, text, and link can be modified by modifying the related page. The Block title can be modified by modifying the title in the taxonomy.
```
<div .. class="view-get-involved ...">
```

### Event Block
It use view-event as the classname. The content is generated from an Event (new content type). The image, text, and link can be modified by modifying the related page. The image, text, and link can be modified by modifying the related page.
```
<div .. class="view-event...">
```

### Blog Block
It use view-blog as the classname. The content is generated from Article. The image, text, and link can be modified by modifying the related page. The image, text, and link can be modified by modifying the related page.
```
<div .. class="view-blog ...">
```

### Single Node Display and Image teaser
![Single node display](https://github.com/sulha199/theme_opencharity/raw/master/single-node.JPG)
It is possible to create teaser image for every node. If a node has a featured image, then it will be displayed as a teaser.
It is done by creating block from view which provide image data, it can create a banner/teaser image for every node. The name of the view should be "view-node-banner". 
```
view name = node-banner
```
```
<div .. class="view-node-banner ...">
```
