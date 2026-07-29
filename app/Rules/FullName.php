<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates a "Full Name" field with strict rules:
 *   - Required (handled separately by 'required' rule)
 *   - Minimum length: 3 characters
 *   - Maximum length: 100 characters
 *   - Letters only (Unicode), spaces allowed; no numbers, symbols, emojis
 *   - No leading or trailing spaces
 *   - No multiple consecutive spaces
 *   - Must start with a letter (not a space)
 *   - Cannot be only spaces
 *   - Cannot contain HTML tags or SQL-like injection characters
 */
class FullName implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $name = (string) $value;

        // --- Cannot be only spaces ---
        if (trim($name) === '') {
            $fail('The full name cannot be empty or consist only of spaces.');

            return;
        }

        // --- No leading or trailing spaces ---
        if ($name !== trim($name)) {
            $fail('The full name must not have leading or trailing spaces.');

            return;
        }

        // --- Minimum length (3 characters after trim) ---
        if (mb_strlen($name) < 3) {
            $fail('The full name must be at least 3 characters.');

            return;
        }

        // --- Maximum length (100 characters) ---
        if (mb_strlen($name) > 100) {
            $fail('The full name must not exceed 100 characters.');

            return;
        }

        // --- Must start with a letter ---
        if (! preg_match('/^\p{L}/u', $name)) {
            $fail('The full name must start with a letter.');

            return;
        }

        // --- No multiple consecutive spaces ---
        if (preg_match('/\s{2,}/', $name)) {
            $fail('The full name must not contain multiple consecutive spaces.');

            return;
        }

        // --- Letters and single spaces only (no numbers, symbols, emojis) ---
        // \p{L} = any Unicode letter, \p{Z} = any Unicode space separator
        // We allow only letters and standard ASCII space between words.
        if (! preg_match('/^[\p{L} ]+$/u', $name)) {
            $fail('The full name may only contain letters and spaces (no numbers, symbols, or emojis).');

            return;
        }

        // --- Cannot contain HTML tags ---
        if ($name !== strip_tags($name) || preg_match('/<[^>]+>/', $name)) {
            $fail('The full name must not contain HTML tags.');

            return;
        }

        // --- Cannot contain SQL-like injection characters ---
        // Blocks: ' " ; -- /* */ = < > ( ) \ |
        if (preg_match('/[\'";=<>()\\\\\|]|--|\\/\*|\*\//', $name)) {
            $fail('The full name must not contain special characters like quotes, semicolons, or brackets.');

            return;
        }
    }
}
