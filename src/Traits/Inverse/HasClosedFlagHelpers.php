<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Cog\Flag\Traits\Inverse;

trait HasClosedFlagHelpers
{
    public function initializeHasClosedFlagHelpers(): void
    {
        $this->casts['is_closed'] = 'boolean';
    }

    /**
     * If entity is closed.
     *
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->getAttributeValue('is_closed');
    }

    /**
     * If entity is opened.
     *
     * @return bool
     */
    public function isOpened(): bool
    {
        return !$this->isClosed();
    }

    /**
     * Mark entity as closed.
     *
     * @return void
     */
    public function close(): void
    {
        $this->setAttribute('is_closed', true);
        $this->save();

        $this->fireModelEvent('closed', false);
    }

    /**
     * Mark entity as opened.
     *
     * @return void
     */
    public function open(): void
    {
        $this->setAttribute('is_closed', false);
        $this->save();

        $this->fireModelEvent('opened', false);
    }
}
