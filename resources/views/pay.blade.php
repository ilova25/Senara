<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<h3>Processing Payment...</h3>

<script>
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            alert("Payment Success");
            window.location.href = "/detail_booking/{{ $booking->id }}";
        },
        onPending: function(result){
            alert("Payment Pending");
            window.location.href = "/detail_booking/{{ $booking->id }}";
        },
        onError: function(result){
            alert("Payment Failed");
        },
        onClose: function(){
            alert("Payment popup closed");
        }
    });
</script>
