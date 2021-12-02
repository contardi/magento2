<?php
/**
 * @package Intelipost\Shipping
 * @copyright Copyright (c) 2021 Bizcommerce
 * @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */

declare(strict_types=1);

namespace Intelipost\Shipping\Api\Data;

interface WebhookSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Token list.
     * @return \Intelipost\Shipping\Api\Data\WebhookInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Intelipost\Shipping\Api\Data\WebhookInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

