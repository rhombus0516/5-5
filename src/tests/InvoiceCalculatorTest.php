<?php
use PHPUnit\Framework\TestCase;
require_once dirname(__DIR__) . '/src/InvoiceCalculator.php';

class InvoiceCalculatorTest extends TestCase {
    public function testCalculateTotal() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 100, 2); // $200
        $calculator->addItem('Item2', 50, 3);  // $150
        $total = $calculator->calculateTotal();
        $this->assertEquals(350, $total);
    }

    public function testApplyDiscount() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 100, 2); // $200
        $calculator->addItem('Item2', 50, 3);  // $150
        $discountedTotal = $calculator->applyDiscount(10); // 10%の割引を適用した合計 $350 -> $315
        $this->assertEquals(315, $discountedTotal);
    }

    public function testApplyInvalidDiscount() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 100, 2); // $200
        $calculator->addItem('Item2', 50, 3);  // $150
        $discountedTotal = $calculator->applyDiscount(110); // 無効な割引 (100%を超える場合)
        $this->assertEquals(0, $discountedTotal); // 最大で100%割引まで適用されると仮定
    }

    public function testAddItemAndCalculateTotal() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 100, 2); // $200
        $calculator->addItem('Item2', 50, 3);  // $150
        $total = $calculator->calculateTotal();
        $this->assertEquals(350, $total);
    }
}
?>
