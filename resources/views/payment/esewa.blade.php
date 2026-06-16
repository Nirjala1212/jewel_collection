<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to eSewa</title>
</head>
<body onload="document.getElementById('esewaForm').submit();">

    <h2 style="text-align:center; margin-top:50px;">
        Redirecting to eSewa Payment...
    </h2>

    <form id="esewaForm"
          action="https://rc-epay.esewa.com.np/api/epay/main/v2/form"
          method="POST">

        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="tax_amount" value="{{ $taxAmount }}">
        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
        <input type="hidden" name="transaction_uuid" value="{{ $transactionUuid }}">
        <input type="hidden" name="product_code" value="{{ $productCode }}">
        <input type="hidden" name="product_service_charge" value="{{ $serviceCharge }}">
        <input type="hidden" name="product_delivery_charge" value="{{ $deliveryCharge }}">

        <input type="hidden" name="success_url" value="{{ route('esewa.success') }}">
        <input type="hidden" name="failure_url" value="{{ route('esewa.failure') }}?transaction_uuid={{ $transactionUuid }}">

        <input type="hidden" name="signed_field_names" value="{{ $signedFieldNames }}">
        <input type="hidden" name="signature" value="{{ $signature }}">

        <noscript>
            <button type="submit">Pay with eSewa</button>
        </noscript>
    </form>

</body>
</html>