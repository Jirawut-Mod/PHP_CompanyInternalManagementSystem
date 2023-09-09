<script>
    const priceUnitInput = document.getElementById('PriceUnit');
    const qtyInput = document.getElementById('Qty');
    const priceInput = document.getElementById('Price');

    priceUnitInput.addEventListener('input', calculateTotalPrice);
    qtyInput.addEventListener('input', calculateTotalPrice);

    function calculateTotalPrice() {
        const priceUnit = parseFloat(priceUnitInput.value) || 0;
        const qty = parseFloat(qtyInput.value) || 0;

        const totalPrice = priceUnit * qty;
        priceInput.value = totalPrice.toFixed();
    }
</script>

<!-- ส่วนที่ตรวจสอบการใส่ข้อมูลในช่อง Note -->
<script>
    const noteInput = document.getElementById('Note');
    const submitButton = document.querySelector('button[type="submit"]');

    noteInput.addEventListener('input', () => {
        if (noteInput.value.trim() === '') {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = false;
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const customerCompanyInput = document.getElementById('CustomerCompany');
        const customerCompanyHiddenInput = document.querySelector('input[name="CustomerCompany"]');

        const budgetProjectInput = document.getElementById('BudgetProject');
        const budgetProjectHiddenInput = document.querySelector('input[name="BudgetProject"]');

        customerCompanyInput.disabled = true;
        customerCompanyHiddenInput.disabled = true;

        budgetProjectInput.disabled = true;
        budgetProjectHiddenInput.disabled = true;
    });
</script>