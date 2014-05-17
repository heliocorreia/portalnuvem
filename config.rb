# Require any additional compass plugins here.
require "susy"

project_type = :stand_alone
project_path = "."

# source assets
sass_dir = "sass/scss"
images_dir = "sass/images"
sprite_load_path = "sass/sprites"

# generated assets
css_dir = "portalnuvem/media/compiled/css"
generated_images_dir = "portalnuvem/media/compiled/images"

# You can select your preferred output style here (can be overridden via the
# command line): output_style = :expanded or :nested or :compact or :compressed
output_style = :expanded

# Indicates whether line comments should be added to compiled css that says
# where the selectors were defined. Defaults to false in production mode, true
# in development mode.
line_comments = false

# Indicates whether line comments should be added to compiled css that says
# where the selectors were defined. Defaults to false in production mode, true
# in development mode.
preferred_syntax = :scss

# Indicates whether the compass helper functions should generate relative urls
# from the generated css to assets, or absolute urls using the http path for
# that asset type.
relative_assets = true
