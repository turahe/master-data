<?php

if (! function_exists('currency')) {
    /**
     * Convert given number.
     *
     * @param float|null $amount
     * @param string|null $from
     * @param string|null $to
     * @param bool $format
     *
     * @return string
     */
    function currency(?float $amount = null, ?string $from = null, ?string $to = null, bool $format = true): string
    {
        if (is_null($amount)) {
            return app('currency');
        }

        return app('currency')->convert($amount, $from, $to, $format);
    }
}

if (! function_exists('currency_format')) {
    /**
     * Format given number.
     *
     * @param float|null $amount
     * @param string|null $currency
     * @param bool $include_symbol
     *
     * @return string
     */
    function currency_format(?float $amount = null, ?string $currency = null, bool $include_symbol = true): string
    {
        return app('currency')->format($amount, $currency, $include_symbol);
    }
}

if (! function_exists('csv_to_array')) {
    function csv_to_array($filename, $header): bool|array
    {
        $delimiter = ',';

        if (! file_exists($filename) || ! is_readable($filename)) {
            return false;
        }

        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
