<!DOCTYPE html>
<html>

<head>
    <style>
        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        /* Styles for the time slots */
        .time-slots {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .time-slot {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            cursor: pointer;
        }

        .time-slot:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <button id="openModal">Select Booking Time</button>

    <!-- The Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <h2>Select Booking Time</h2>
            <div class="time-slots">
                <!-- Generate time slots -->
                <?php
                $startTime = strtotime("09:00 AM");
                $endTime = strtotime("09:00 PM");
                while ($startTime < $endTime) {
                    $time = date("h:i A", $startTime);
                    echo "<div class='time-slot' data-time='$time'>$time</div>";
                    $startTime = strtotime('+30 minutes', $startTime);
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("bookingModal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModal");

        // Get all time slots
        var timeSlots = document.querySelectorAll(".time-slot");

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on a time slot, set the selected time
        timeSlots.forEach(function (slot) {
            slot.onclick = function () {
                var selectedTime = slot.getAttribute("data-time");
                // You can use 'selectedTime' as the booking time
                alert("Selected Time: " + selectedTime);
                modal.style.display = "none";
            }
        });

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>