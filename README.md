# Drupal 7 Theme for Open Charity

This theme is build based on basic javascript and css. The css is generated using css predecessor, it is compiled using compass.

## Getting Started
Please follow instruction on how to install theme in Drupal 7

## Regions
The regions in this theme are :
1. Navigation : top right of the page
2. Header : before the content
3. Main
4. Sidebar
5. Footer

## Home Banner Block
The home banner uses view-home-banner as the classname. The image and text is generated from a basic page so it can be modified by modifying the related page.
```
<div .. class="view-home-banner ...">
```

## Get Involved, Our Mission, and Members Block
It use view-get-involved, view-mission, view-members as the classname respectively. The image, text, and link can be modified by modifying the related page. The Block title can be modified by modifying the title in the taxonomy.
```
<div .. class="view-get-involved ...">
```

## Event Block
It use view-event as the classname. The content is generated from an Event (new content type). The image, text, and link can be modified by modifying the related page. The image, text, and link can be modified by modifying the related page.
```
<div .. class="view-event...">
```

## Blog Block
It use view-blog as the classname. The content is generated from Article. The image, text, and link can be modified by modifying the related page. The image, text, and link can be modified by modifying the related page.
```
<div .. class="view-blog ...">
```

## Image teaser
By creating block from view which provide image data, it can create a banner/teaser image for every node. The name of the view should be "view-node-banner".
```
view name = node-banner
```
```
<div .. class="view-node-banner ...">
```

## Slider
Slider is used to create a responsive content-slider in members and blog block. To use the slider just add the following classes
```
<div .. class="flex-slider flex-width-200 ...">
```
The class width 200 is to set the min-width to be 200px, hence if you want to set the min-width to 300 then write the class as follows
```
<div .. class="flex-slider flex-width-300  ...">
```
By default, the slider will have bullet button below the content, you can change the button to become arrow and put it on the side by add another classname so it becomes
```
<div .. class="flex-slider flex-width-300 flex-sidebutton ...">
```