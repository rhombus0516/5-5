<?php

use PHPUnit\Framework\TestCase;
require_once dirname(__DIR__) . '/InvoiceCalculator.php';

class InvoiceCalculatorTest extends TestCase {
    public function testAddItemAndCalculateTotal() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 200); // $200
        $calculator->addItem('Item2', 150);  // $150
        $total = $calculator->calculateTotal();
        $this->assertEquals(350, $total);
    }

    public function testApplyDiscountWithValidCode() {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 200); // $200
        $calculator->addItem('Item2', 150); // $150

        // 'DISCOUNT10' を適用したテスト
        $discountedTotal = $calculator->applyDiscount('DISCOUNT10'); // 10%の割引を適用した合計 $350 -> $315
        $this->assertEquals(315, $discountedTotal);

        // 'DISCOUNT20' を適用したテスト
        $discountedTotal = $calculator->applyDiscount('DISCOUNT20'); // 20%の割引を適用した合計 $350 -> $280
        $this->assertEquals(280, $discountedTotal);
    }

    public function testApplyDiscountWithInvalidCode () {
        $calculator = new InvoiceCalculator();
        $calculator->addItem('Item1', 200); // $200
        $calculator->addItem('Item2', 150);  // $150
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid discount code');

        // 無効な割引 (100%を超える場合)
        $calculator->applyDiscount(110);// 最大で100%割引まで適用されると仮定
    }

    
}
?>
