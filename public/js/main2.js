const app = new Vue({
    el: "#app",  

    data: {
        route: {},
        trip: {},
        trips: {},
        tripDetails: {},
        currentTab: 0, 
        passengers: 0,
        fare:0,
        totalFare:0,
        paymentStatus:"pending",
        transactionId:null,
        passengerList: {},
        fetchedTrips: {},
        modalDatatable: null,
        payments: {},
        bookings: {},
        janCount: 0, febCount: 0, marchCount: 0, aprilCount: 0, mayCount: 0, juneCount: 0,
        julyCount: 0, augustCount: 0, septemberCount: 0, octoberCount: 0, novemberCount: 0, decemberCount: 0,

        janCount2: 0, febCount2: 0, marchCount2: 0, aprilCount2: 0, mayCount2: 0, juneCount2: 0,
        julyCount2: 0, augustCount2: 0, septemberCount2: 0, octoberCount2: 0, novemberCount2: 0, decemberCount2: 0
    },

    created: function () {
        $('.datatable').DataTable()    
        $("#btn_loader").hide()    
    },

    mounted() {
        this.getPage();
    },

    watch: {
        trips(val) {
            this.$nextTick(() => {
                this.modalDatatable = $('.modal_datatable').DataTable()    
            });
        },
    },

    methods: {   
        getPage() {
            var page = $(".page_name").attr("id");

            if(page == "CreateBooking") {
                this.showTab(this.currentTab)
            }
            else if(page == "Home") {
                this.payments = $("#payments").val()
                this.bookings = $("#bookings").val()

                this.lineGraph()
                this.paymentsGraph()
            }
        },

        createTrip() {    
            var that = this

            var departureDate = $('#departure_date').val()
            var departureTime = $('#departure_time').val()
            var departureDateTime = departureDate + " " + departureTime
            var departureTimestamp = (new Date(departureDateTime).getTime()/1000)
    
            var tripDuration = that.route.trip_duration
            var tripDurationTimestamp = 3600 * parseInt(tripDuration)
            var arrivalTimestamp = departureTimestamp + tripDurationTimestamp   
    
            $.ajax({
                url: '/obrs/trip',
                method: "POST",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'departure_location': that.route.departure,
                    'arrival_location': that.route.arrival,
                    'departure_date': $('#departure_date').val(),
                    'departure_time': $('#departure_time').val(),
                    'departure_datetime': departureTimestamp,
                    'trip_duration': tripDuration,
                    'arrival_timestamp': arrivalTimestamp,
                    'class_fare': $('#class_fare').val(),
                    'bus_id': $('#bus_id').val(),
                    'route_id': that.route.id
                },
                success: function(data) {
                    alert("Trip created successfully")
                    location.reload()
                },
                error: function(error) {
                    alert(error.responseJSON.message)
                }
            })
        },

        changeStatus() {
            var status = $("#status").val()

            if(status == 'cancelled') {            
                $(".cancellation_reason").show()
            }
            else {
                $(".cancellation_reason").hide()
            }
        },

        updateTrip() {
            var status = $("#status").val()

            $("#update_spinner").show()
            $("#update_text").hide()

            if(status == "cancelled") {
                if(confirm("Are you sure you want to cancel this trip?")){
                    updateTrip()
                }
                else{
                    return false;
                }
            }
            else {
                updateTrip()
            }
    
            function updateTrip() {
                var departureDate = $('#departure_date').val()
                var departureTime = $('#departure_time').val()
                var departureDateTime = departureDate + " " + departureTime
                var departureTimestamp = (new Date(departureDateTime).getTime()/1000)
    
                var tripDuration = $('#trip_duration').val()
                var tripDurationTimestamp = 3600 * parseInt(tripDuration)
                var arrivalTimestamp = departureTimestamp + tripDurationTimestamp   
    
                $.ajax({
                    url: '/obrs/trip/' + $("#trip_id").val(),
                    method: "PUT",
                    headers: { "Accept": "application/json; odata=verbose" },
                    data: {
                        "_token": $('#csrf-token')[0].content,
                        'departure_date': $('#departure_date').val(),
                        'departure_time': $('#departure_time').val(),
                        'departure_datetime': departureTimestamp,
                        'arrival_timestamp': arrivalTimestamp,
                        'class_fare': $('#class_fare').val(),
                        'bus_id': $('#bus_id').val(),
                        'status': status,
                        'cancellation_reason': $("#cancellation_reason").val()
                    },
                    success: function(data) {
                        $("#update_spinner").hide()
                        $("#update_text").show()

                        alert("Trip updated successfully")
                        window.location.replace("/obrs/trip");
                    },
                    error: function(error) {
                        alert(error.responseJSON.message)
                    }
                })
            }    
        },

        showModal(trip) {
            $("#details_modal").modal("toggle");
            this.trip = trip;
        },

        showPassengersModal(trip) {
            var that = this
            var tripId = trip.id

            that.tripDetails = trip;
            
            $.ajax({
                url: '/obrs/trip/bookings/' + tripId,
                method: "GET",
                headers: { "Accept": "application/json; odata=verbose" },
                success: function (data) {
                    that.passengerList = data
                    $("#details_modal").modal("toggle");
                },
                error: function (error) {
                    alert(error)
                }
            });           
        },

        next() {
            var text = $("#nextBtn").text();
            this.nextPrev(1, text);
        },

        previous() {
            var text = $("#prevBtn").text();
            this.nextPrev(-1, text);
        },

        nextPrev(n, text) {
            var that = this;

            //if the current tab is background (validated on modal toggle) or when the previous button is clicked, don't validate
            if(that.currentTab == 1 || n == -1) {
                updateProgress();
            }
            else {
                if(text == "Submit") {
                    that.submitBooking()
                }
                else {
                    updateProgress();
                } 
            }           
            
            function updateProgress() {
                var x = document.getElementsByClassName("tab");
                x[that.currentTab].style.display = "none";
                that.currentTab = that.currentTab + n;

                if (that.currentTab >= x.length) {
                    return false;
                }                
                that.showTab(that.currentTab);
            }
        },

        showTab(n) {
            var that =this;

            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";

                if(that.paymentStatus == "pending") {
                    $('#nextBtn').prop('disabled', true);
                }
                else {
                    $('#nextBtn').prop('disabled', false);
                }
                
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
                $('#nextBtn').prop('disabled', false);
            }
            this.fixStepIndicator(n)
        },

        fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            
            x[n].className += " active";

            var i, x = document.getElementsByClassName("stp");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            
            x[n].className += " active";
        },

        generatePersonalDetails(trip) {
            var that = this;
            that.passengers = $("#tickets").val()
            that.fare = trip.class_fare
            that.totalFare = that.passengers * that.fare

            $('.passenger_details_one').slice(1).remove();           

            if(that.passengers > 1) {
                for (var i = 1; i < that.passengers; i++) { 
                    var passengerDetails = $('.passenger_details_one:first').clone()
                        .find('input').val('').end()
                        .appendTo('.passenger_details')
                }
            }    
        },

        initiateTransaction() {
            var that = this

            $("#pay_now_spinner").show()
            $("#pay_now_text").hide()

            $.ajax({
                url: '/obrs/payment/initiate',
                method: "POST",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'billing_number': $('#billing_number').val(),
                    'email': $('#billing_email').val(),
                    'amount': that.totalFare,
                },
                success: function(data) {                    
                    that.paymentStatus = "complete"
                    that.transactionId = data.id

                    alert("Payment posted successfully. Proceed to submit your booking")

                    $('#nextBtn').prop('disabled', false);

                    $("#pay_now_spinner").hide()
                    $("#pay_now_text").show()
                   
                    $("#pending_payment_status").hide()
                    $("#paid_payment_status").show()                    
                },
                error: function(error) {
                    alert(error.responseJSON.message)

                    $("#pay_now_spinner").hide()
                    $("#pay_now_text").show()
                }
            })
        },

        submitBooking() {
            $("#btn_loader").show()
            $("#nextBtn").hide()

            var that = this;
            let passengerList = []
            let count = 0
            let totalTickets =  $("#tickets").val()
            
            $("input[name='full_name[]']").each(function (index) {
                passengerList.push({
                    'trip_id': that.trip.id,  
                    'payment_id': that.transactionId,  
                    'full_name': $(`[name="full_name[]"]:eq(${index})`).val(),
                    'id_number': $(`[name="id_number[]"]:eq(${index})`).val(),
                    'phone_number': $(`[name="phone_number[]"]:eq(${index})`).val(),
                    'email': $(`[name="email[]"]:eq(${index})`).val(),     
                });
            });

            $.each(passengerList, function (key, passenger) {
                $.ajax({
                    url: '/obrs/booking',
                    method: "POST",
                    headers: { "Accept": "application/json; odata=verbose" },
                    data: {
                        "_token": $('#csrf-token')[0].content,
                        "total_tickets": totalTickets,
                        'trip_id': passenger.trip_id,  
                        'payment_id': passenger.payment_id,  
                        'full_name': passenger.full_name,
                        'id_number': passenger.id_number,
                        'phone_number': passenger.phone_number,
                        'email': passenger.email,     
                    },
                    success: function(data) {
                        count ++ 

                        if(count == totalTickets) {
                            alert("Tickets purchased successfully!")  
                            $("#btn_loader").hide()
                            $("#nextBtn").show()

                            location.reload()
                        }                        
                    },
                    error: function(error) {
                        alert(error.responseJSON.message)

                        $("#btn_loader").hide()
                        $("#nextBtn").show()
                    }
                })
            });
        },

        createBus() {
            $.ajax({
                url: '/obrs/bus',
                method: "POST",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'bus_type': $('#bus_type').val(),
                    'registration_number': $('#registration_number').val(),
                    'total_seats': $('#total_seats').val()
                },
                success: function(data) {
                    alert("Bus created successfully")
                    location.reload()
                },
                error: function(error) {
                    alert(error.responseJSON.message)
                }
            })
        },

        showBusScheduleModal(bus) {
            var that = this

            $.ajax({
                url: '/obrs/bus/schedule/' + bus.id,
                method: "GET",
                headers: { "Accept": "application/json; odata=verbose" },
                success: function (data) {
                    that.fetchedTrips = data
                    $("#details_modal").modal("toggle");  
                },
                error: function (error) {
                    alert(error.responseJSON.message)
                }
            }); 
        },

        updateBus() {
            var that = this

            $.ajax({
                url: '/obrs/bus/' + $("#bus_id").val(),
                method: "PUT",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'bus_type': $('#bus_type').val(),
                    'registration_number': $('#registration_number').val(),
                    'total_seats': $('#total_seats').val()
                },
                success: function(data) {
                    alert("Bus updated successfully")
                    window.location.replace("/bus");
                },
                error: function(error) {
                    alert(error.responseJSON.message)
                }
            })  
        },

        updateUser() {
            var that = this

            $.ajax({
                url: '/obrs/user/' + $("#user_id").val(),
                method: "PUT",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'role': $('#role').val()
                },
                success: function(data) {
                    alert("User updated successfully")
                    window.location.replace("/obrs/users");
                },
                error: function(error) {
                    alert(error.responseJSON.message)
                }
            })  
        },

        lineGraph() {
            var that = this

            $.each(JSON.parse(that.bookings), function (key, value) {
                var itemYear = (new Date(value.created_at)).getFullYear();
                var itemMonth = (new Date(value.created_at)).getMonth();

                if (itemYear == 2020) {
                    switch (itemMonth + 1) {
                        case 1:
                            that.janCount++
                            break;
                        case 2:
                            that.febCount++
                            break;
                        case 3:
                            that.marchCount++
                            break;
                        case 4:
                            that.aprilCount++
                            break;
                        case 5:
                            that.mayCount++
                            break;
                        case 6:
                            that.juneCount++
                            break;
                        case 7:
                            that.julyCount++
                            break;
                        case 8:
                            that.augustCount++
                            break;
                        case 9:
                            that.septemberCount++
                            break;
                        case 10:
                            that.octoberCount++
                            break;
                        case 11:
                            that.novemberCount++
                            break;
                        case 12:
                            that.decemberCount++
                            break;
                    }
                }
            });
            
            var ctxL = document.getElementById("lineChart").getContext('2d');
            var myLineChart = new Chart(ctxL, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Bookings log",
                        data: [that.janCount, that.febCount, that.marchCount, that.aprilCount, that.mayCount, 
                            that.juneCount, that.julyCount, that.augustCount, that.septemberCount, that.octoberCount, that.novemberCount, that.decemberCount],
                        backgroundColor: [
                            'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(0, 10, 130, .7)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true
                }
            });
        },

        paymentsGraph() {
            var that = this

            $.each(JSON.parse(that.payments), function (key, value) {
                var itemYear = (new Date(value.created_at)).getFullYear();
                var itemMonth = (new Date(value.created_at)).getMonth();

                if (itemYear == 2020) {
                    switch (itemMonth + 1) {
                        case 1:
                            that.janCount2++
                            break;
                        case 2:
                            that.febCount2++
                            break;
                        case 3:
                            that.marchCount2++
                            break;
                        case 4:
                            that.aprilCount2++
                            break;
                        case 5:
                            that.mayCount2++
                            break;
                        case 6:
                            that.juneCount2++
                            break;
                        case 7:
                            that.julyCount2++
                            break;
                        case 8:
                            that.augustCount2++
                            break;
                        case 9:
                            that.septemberCount2++
                            break;
                        case 10:
                            that.octoberCount2++
                            break;
                        case 11:
                            that.novemberCount2 += parseInt(value.amount)
                            console.log(that.novemberCount2)
                            break;
                        case 12:
                            that.decemberCount2++
                            break;
                    }
                }
            });

            var ctxL = document.getElementById("paymentsChart").getContext('2d');
            var myLineChart = new Chart(ctxL, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Payments log",
                        data: [that.janCount2, that.febCount2, that.marchCount2, that.aprilCount2, that.mayCount2, 
                            that.juneCount2, that.julyCount2, that.augustCount2, that.septemberCount2, that.octoberCount2, that.novemberCount2, that.decemberCount2],
                        backgroundColor: [
                            'rgba(105, 0, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(200, 99, 132, .7)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true
                }
            });
        },

        createRoute() {
            $.ajax({
                url: '/obrs/route',
                method: "POST",
                headers: { "Accept": "application/json; odata=verbose" },
                data: {
                    "_token": $('#csrf-token')[0].content,
                    'departure': $('#departure').val(),
                    'arrival': $('#arrival').val(),
                    'trip_duration': $('#trip_duration').val()
                },
                success: function(data) {
                    alert("Route created successfully")
                    location.reload()
                },
                error: function(error) {
                    alert(error.responseJSON.message)
                }
            })
        },

        showRouteScheduleModal(route) {
            var that = this

            $.ajax({
                url: '/obrs/route/schedule/' + route.id,
                method: "GET",
                headers: { "Accept": "application/json; odata=verbose" },
                success: function (data) {
                    that.fetchedTrips = data
                    $("#details_modal").modal("toggle"); 
                },
                error: function (error) {
                    alert(error.responseJSON.message)
                }
            }); 
        },

        setRoute(route) {
            var that = this

            that.route = JSON.parse(route.target.value)           
        }
    }
})