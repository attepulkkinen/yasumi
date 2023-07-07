<?php

declare(strict_types=1);

/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2023 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Translation;

use Yasumi\Exception\UnknownLocaleException;

class Translations implements TranslationsInterface
{
    /**
     * @var array<string, mixed[]>|mixed|array<string, mixed>
     */
    public $translations;

    /** @param array<string> $availableLocales list of all defined locales */
    public function __construct(private array $availableLocales)
    {
    }

    /**
     * Loads translations from a given directory.
     *
     * @param string $directoryPath directory path for translation files
     *
     * @throws UnknownLocaleException
     * @throws \InvalidArgumentException
     */
    public function loadTranslations(string $directoryPath): void
    {
        if (! file_exists($directoryPath)) {
            throw new \InvalidArgumentException('Directory with translations not found');
        }

        $directoryPath = rtrim($directoryPath, '/\\').\DIRECTORY_SEPARATOR;
        $extension = 'php';

        foreach (new \DirectoryIterator($directoryPath) as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                continue;
            }

            if ($file->getExtension() !== $extension) {
                continue;
            }

            $filename = $file->getFilename();
            $key = $file->getBasename('.'.$extension);

            $translations = require $directoryPath.$filename;

            if (\is_array($translations)) {
                foreach (array_keys($translations) as $locale) {
                    $this->checkLocale((string) $locale);
                }

                $this->translations[$key] = $translations;
            }
        }
    }

    /**
     * Adds a translation for the given holiday in a specific locale.
     *
     * @param string $key         holiday key
     * @param string $locale      locale
     * @param string $translation translation
     *
     * @throws UnknownLocaleException
     */
    public function addTranslation(string $key, string $locale, string $translation): void
    {
        $this->checkLocale($locale);

        $this->translations[$key][$locale] = $translation;
    }

    public function getTranslation(string $key, string $locale): ?string
    {
        return $this->translations[$key][$locale] ?? null;
    }

    public function getTranslations(string $key): array
    {
        return $this->translations[$key] ?? [];
    }

    private function checkLocale(string $locale): void
    {
        if (! \in_array($locale, $this->availableLocales, true)) {
            throw new UnknownLocaleException(sprintf('Locale "%s" is not a valid locale.', $locale));
        }
    }
}
