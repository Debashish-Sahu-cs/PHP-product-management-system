<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        form {
            background: #fff;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .radio-group input {
            display: flex;
            color: darkgray;
            gap:0;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content:space-between;
        }
        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .submit-btn {
            background: #28a745;
            color: white;
        }
        .cancel-btn {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <form action="orderValidation.php" method="POST">
        <h2>Place Your Order</h2>

        <label for="prodCategory">Product Category:</label>
        <div class="radio-group">
            <input type="radio" name="prodCategory" value="Electronics" required>Electronics
            <input type="radio" name="prodCategory" value="Books">Books
            <input type="radio" name="prodCategory" value="Beauty">Beauty
            <input type="radio" name="prodCategory" value="HomeCare">Home Care
            <input type="radio" name="prodCategory" value="Clothing">Clothing
        </div>

        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required>

        <label for="vendorName">Vendor Name:</label>
        <input type="text" id="vendorName" name="vendorName" required>

        <label for="vendorState">Vendor State:</label>
        <select id="vendorState" name="vendorState" required>
            <option value="">-- Select State --</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Delhi">Delhi</option>
            <option value="West Bengal">West Bengal</option>
        </select>

        <label for="vendorCity">Vendor City:</label>
        <select id="vendorCity" name="vendorCity" required>
            <option value="">-- Select City --</option>
            <option value="Surat">Surat</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Delhi">Delhi</option>
            <option value="Kolkata">Kolkata</option>
        </select>

        <label for="vendorContact">Vendor Contact No:</label>
        <input type="number" id="vendorContact" name="vendorContact" required placeholder="10-digit number">

        <label for="itemPrice">Item Price:</label>
        <input type="number" id="itemPrice" name="itemPrice" required step="0.01" readonly>

        <label for="itemQty">Item Quantity:</label>
        <select id="itemQty" name="itemQty" required>
            <option value="">-- Select Quantity --</option>
            <?php 
                for($i=1; $i<=10; $i++){
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>

        <label for="shippingAddress">Shipping Address:</label>
        <textarea id="shippingAddress" name="shippingAddress" rows="3" required></textarea>

        <label for="orderDate">Order Date:</label>
        <input type="date" id="orderDate" name="orderDate" value="<?php echo date('Y-m-d'); ?>" readonly> <!-- readonly ensures that the user can not override the text -->

        <div class="btn-group">
            <button type="submit" class="submit-btn">Submit</button>
            <button type="reset" class="cancel-btn">Cancel</button>
        </div>
    </form>
<script>
    /* --------- basic helpers --------- */
    function getSelectedCategory() {
      const el = document.querySelector('input[name="prodCategory"]:checked');
      return el ? el.value : '';
    }

    function debounce(fn, delay) {
      let timer = null;
      return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
      };
    }

    async function fetchPrice() {
      const itemName = document.getElementById('itemName').value.trim();
      const prodCategory = getSelectedCategory();

      const formData = new FormData();
      formData.append('itemName', itemName);
      formData.append('prodCategory', prodCategory);

      try {
        const resp = await fetch('fetch_price.php', {
          method: 'POST',
          body: formData
        });

        const data = await resp.json();
        if (data.success && data.price !== null) {
          document.getElementById('itemPrice').value = data.price;
        }

      } catch (err) {
        console.error('Fetch error:', err);
        document.getElementById('itemPrice').value = '';
      }
    }

    /* add listeners */
    // when the category changes (radios)
    document.querySelectorAll('input[name="prodCategory"]').forEach(res => {
      res.addEventListener('change', fetchPrice);
    });

    // when user changes item name — use debounce for typing
    document.getElementById('itemName').addEventListener('input', debounce(fetchPrice, 100));

</script>

</body>
</html>
