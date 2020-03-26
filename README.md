# Alphakat Art Generator Custom Plugin

To run this in dev mode, use `npm start` to compile the styles


To build the plugin for uploading to WordPress, run `npm build` which bundles all the necessary files into a zip file, called `alphakat.zip`


## How to use in WordPress

This is a shortcode, which you can add to any page or section you like (designed to work best in full width sections.)

Add the following shortcode where you want the generator in your template.

```
[alphakat_generator]
```

If you want to change the default title, add it to the shortcode

```
[alphakat_generator title="New Title"]
```

If you want to add a subtitle, you can add it as content for the shortcode (this is designed to be one paragraph, just a couple of sentences)

```
[alphakat_generator]Here is the subtitle[/alphakat_generator]
```

You can also define both the title and subtitle

```
[alphakat_generator title="New Title"]Here is the subtitle[/alphakat_generator]
```