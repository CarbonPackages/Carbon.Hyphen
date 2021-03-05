[![Latest stable version]][packagist] [![Total downloads]][packagist] [![License]][packagist] [![GitHub forks]][fork] [![GitHub stars]][stargazers] [![GitHub watchers]][subscription]

# Carbon.Hyphen Package for Neos CMS

## Make hyphens easier

Optional word-breaks are hard to enter in Neos CMS. This package provides a Fusion wrapper for [phpSyllable]

## Installation

```bash
composer require carbon/hyphen
```

## Usage

### Text

Just use the `Carbon.Hyphen:Text` Fusion object as a processor or wrapper on the Fusion value that should be hyphenated.

```elm
superlongValue = 'supercalifragilisticexpialidocious'
superlongValue.@process.hyphenate = Carbon.Hyphen:Text {
  locale = 'en-gb'
}
```

### HTML

Similar to text elements you can use `Carbon.Hyphen:Html` for HTML elements.

```elm
someFusionHtml.@process.hyphenate = Carbon.Hyphen:Html
```

## Neos CMS integration example

You can easily activate hyphenation for all Neos CMS text- and headline nodetypes with following Fusion code:

```elm
prototype(Foo.Bar:Content.Text) {
  renderer.@process.hyphenate = Carbon.Hyphen:Html
}

prototype(Foo.Bar:Content.Headline) {
  title.@process.hyphenate = Carbon.Hyphen:Text
}
```

or directly on a specific parameter:

```elm
prototype(Foo.Bar:Component) {
    headline = Neos.Neos:Editable {
        property = 'headline'
        block = false
    }

    renderer = afx`
        <h2>
            <Carbon.Hyphen:Text>{props.headline}</Carbon.Hyphen:Text>
        </h2>
    `
}
```

## Parameters

**locale** (string) : Reference to the language in which the given string will be hyphenated  
(Have a look at [syllable languages] for a reference of available languages)

**threshold** (integer, default = `0`) : Minimum amount characters a word needs to have, before it is being hyphenated.

**throwException** (boolean, default = `true`) : Throw exception if no hyphen definition is found

## Credits

This implementation was heavily inspired by [packagefactory/hyphenate].

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
[phpsyllable]: https://github.com/vanderlee/phpSyllable
[syllable languages]: https://github.com/vanderlee/phpSyllable/tree/master/languages
[packagefactory/hyphenate]: https://github.com/PackageFactory/hyphenate
