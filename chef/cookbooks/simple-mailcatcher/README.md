# Description

This cookbook installs simple-mailcatcher using chefs' embedded ruby.

# Requirements

## Platform:

*No platforms defined*

## Cookbooks:

*No dependencies defined*

# Attributes

* `node['mailcatcher']['user']` -  Defaults to `mailcatcher`.
* `node['mailcatcher']['group']` -  Defaults to `mailcatcher`.
* `node['mailcatcher']['dir']` -  Defaults to `/opt`.
* `node['mailcatcher']['version']` -  Defaults to `0.6.2`.
* `node['mailcatcher']['smtp']['ip']` -  Defaults to `0.0.0.0`.
* `node['mailcatcher']['smtp']['port']` -  Defaults to `1025`.
* `node['mailcatcher']['http']['ip']` -  Defaults to `0.0.0.0`.
* `node['mailcatcher']['http']['port']` -  Defaults to `1080`.

# Recipes

* simple-mailcatcher::default
* simple-mailcatcher::install
* simple-mailcatcher::service_init
* simple-mailcatcher::user

# License and Maintainer

Maintainer:: Yauhen Artsiukhou (<jsirex@gmail.com>)
Source:: https://github.com/jsirex/simple-mailcatcher-cookbook
Issues:: https://github.com/jsirex/simple-mailcatcher-cookbook/issues

License:: apache 2
