[![Latest stable version]][packagist] [![Total downloads]][packagist] [![License]][packagist] [![GitHub forks]][fork] [![GitHub stars]][stargazers] [![GitHub watchers]][subscription]

# Carbon.Hyphen Package for Neos CMS

## Make hyphens easier

Optional word-breaks are hard to enter in Neos CMS. This Neos package provides a helper to replace occurences of `||` with the Soft hyphen `&shy;`.

## Installation

Most of the time you have to make small adjustments to a package (e.g. configuration in `Settings.yaml`). Because of that, it is important to add the corresponding package to the composer from your theme package. Mostly this is the site packages located under `Packages/Sites/`. To install it correctly go to your theme package (e.g.`Packages/Sites/Foo.Bar`) and run following command:

```
composer require carbon/hyphen --no-update
```

The `--no-update` command prevent the automatic update of the dependencies. After the package was added to your theme `composer.json`, go back to the root of the Neos installation and run `composer update`. Et voilà! Your desired package is now installed correctly.

## License

Licensed under MIT, see [LICENSE](LICENSE)

[packagist]: https://packagist.org/packages/carbon/hyphen
[latest stable version]: https://poser.pugx.org/carbon/hyphen/v/stable
[total downloads]: https://poser.pugx.org/carbon/hyphen/downloads
[license]: https://poser.pugx.org/carbon/hyphen/license
[github forks]: https://img.shields.io/github/forks/CarbonPackages/Carbon.Hyphen.svg?style=social&label=Fork
[github stars]: https://img.shields.io/github/stars/CarbonPackages/Carbon.Hyphen.svg?style=social&label=Stars
[github watchers]: https://img.shields.io/github/watchers/CarbonPackages/Carbon.Hyphen.svg?style=social&label=Watch
[fork]: https://github.com/CarbonPackages/Carbon.Hyphen/fork
[stargazers]: https://github.com/CarbonPackages/Carbon.Hyphen/stargazers
[subscription]: https://github.com/CarbonPackages/Carbon.Hyphen/subscription
