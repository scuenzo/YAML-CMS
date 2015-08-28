<?php
/* return absolute URL */
function url($path){
    global $app;
    return $app->request->getRootUri() . '/' . trim($path, '/');
}

/* Get a quick instance of PagesCollection from a path */
function pages($path, $depth = 0){
    return new \App\PagesCollection($path, $depth);
}

/* Return the URL for the Page or the route */
function route($path){
    global $app;
    return $app->urlFor(is_string($path) ? $path : $path->getName());
}