<?php

interface  IPaymentRepository {

    public function debitPayment();

    public function creditPayment();

    public function biletPayment();
}
