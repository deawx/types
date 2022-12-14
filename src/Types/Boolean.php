<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Throwable;

class Boolean
{
    /**
     * @var bool
     */
    protected bool $value;

    /**
     * @param bool $value
     */
    protected function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_bool($value);
    }

    /**
     * @param bool $value
     * @return static
     */
    public static function from(bool $value): static
    {
        return new static($value);
    }

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function tryFrom(mixed $value): ?static
    {
        try {
            return new static($value);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function innFrom(mixed $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidTypeHttpException
     */
    public static function fromTruthyString(string $value): static
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if (!static::isValid($filteredValue)) throw new InvalidTypeHttpException("Invalid truthy string.");
        return new static($filteredValue);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->getValue() === $value->getValue();
    }
}
