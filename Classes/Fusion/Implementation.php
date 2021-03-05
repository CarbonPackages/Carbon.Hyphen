<?php

namespace Carbon\Hyphen\Fusion;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Utility\Environment;
use Neos\Flow\I18n\Service as LocalizationService;
use Neos\Flow\Package\PackageManager;
use Neos\Utility\Files;
use Neos\Fusion\FusionObjects\AbstractFusionObject;
use Vanderlee\Syllable\Hyphen;
use Vanderlee\Syllable\Syllable;

class Implementation extends AbstractFusionObject
{
    /**
     * @Flow\Inject
     * @var Environment
     */
    protected $environment;

    /**
     * @Flow\Inject
     * @var PackageManager
     */
    protected $packageManager;

    /**
     * @Flow\Inject
     * @var LocalizationService
     */
    protected $localizationService;

    protected $languagesDirectory;

    public function getContent()
    {
        return $this->fusionValue('content');
    }

    public function getLocale()
    {
        if ($locale = $this->fusionValue('locale')) {
            return $locale;
        }

        return (string) $this->localizationService->getConfiguration()->getCurrentLocale();
    }

    public function getType()
    {
        return strtolower($this->fusionValue('type'));
    }

    public function getThreshold()
    {
        return $this->fusionValue('threshold');
    }

    public function getThrowException()
    {
        return $this->fusionValue('throwException');
    }

    public function texFileExists(string $language): bool
    {
        return file_exists(Files::concatenatePaths([$this->languagesDirectory, "hyph-{$language}.tex"]));
    }

    public function evaluate()
    {
        $package = $this->packageManager->getPackage('vanderlee.syllable');
        $this->languagesDirectory = Files::concatenatePaths([
            $package->getPackagePath(),
            'languages'
        ]);
        $cacheDirectory = Files::concatenatePaths([
            $this->environment->getPathToTemporaryDirectory(),
            (string) $this->environment->getContext(),
            'Carbon_Hyphen_Language_Cache'
        ]);

        Files::createDirectoryRecursively($cacheDirectory);

        $language = str_replace('_', '-', strtolower($this->getLocale()));

        if (!$this->texFileExists($language)) {
            $firstPartOfLanguage = explode('-', $language)[0];
            if ($firstPartOfLanguage === $language) {
                if ($this->getThrowException()) {
                    throw new \Exception("Hyphen definition for '$language' is not available", 1614949800);
                }
                return $this->getContent();
            }
            if (!$this->texFileExists($firstPartOfLanguage)) {
                if ($this->getThrowException()) {
                    throw new \Exception("Hyphen definition for '$firstPartOfLanguage' is not available", 1614949900);
                }
                return $this->getContent();
            }
            $language = $firstPartOfLanguage;
        }

        $syllable = new Syllable($language);

        $syllable->getSource()->setPath($this->languagesDirectory);
        $syllable->getCache()->setPath($cacheDirectory);

        $syllable->setHyphen(new Hyphen\Soft());
        $syllable->setMinWordLength($this->getThreshold());

        switch ($this->getType()) {
            case 'html':
                $html = mb_convert_encoding($this->getContent(), 'HTML-ENTITIES', "UTF-8");
                $result = $syllable->hyphenateHtml($html);
                break;
            case 'test':
                // Break missing intendedly
            default:
                $result = $syllable->hyphenateText($this->getContent());
                break;
        }
        return $result;
    }
}
