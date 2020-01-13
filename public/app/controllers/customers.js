app.controller("customersController", function(
    $scope,
    $http,
    API_URL,
    CSRF_TOKEN
) {
    //fetch customers listing from
    $http({
        method: "GET",
        url: API_URL + "customer/all"
    }).then(
        function(response) {
            // $scope.customers = response.data.customers;
            // response.data.customers.forEach(el => console.log(el.email));
            $scope.customers = response.data.customers;
        },
        function(error) {
            console.log(error);
            alert(
                "This is embarassing. An error has occurred. Please check the log for details"
            );
        }
    );

    //show modal form

    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;
        $scope.customer = null;

        switch (modalstate) {
            case "add":
                $scope.form_title = "Add New Customer";
                break;
            case "edit":
                $scope.form_title = "Customer Detail";
                $scope.id = id;
                $http
                    .get(API_URL + "customer/item/" + id)
                    .then(function(response) {
                        console.log(response);
                        $scope.customer = response.data.customer;
                    });
                break;
            default:
                break;
        }

        console.log(id);
        $("#myModal").modal("show");
    };

    //save new record and update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "customer/create";
        var method = "POST";

        //append customer id to the URL if the form is in edit mode
        if (modalstate === "edit") {
            url = "customer/edit/" + id;
        }

        $http({
            method: method,
            url: url,
            data: $.param($scope.customer),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                Authorization: "Bearer " + CSRF_TOKEN
            }
        }).then(function(response) {
            console.log(response);
            console.log("success");
            location.reload();
        }),
            function(error) {
                console.log(error);
                alert(
                    "This is embarassing. An error has occurred. Please check the log for details"
                );
            };
    };

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm("Are you sure you want this record?");
        if (isConfirmDelete) {
            $http({
                method: "POST",
                url: API_URL + "customer/delete/" + id
            }).then(
                function(response) {
                    console.log(response);
                    location.reload();
                },
                function(error) {
                    console.log(error);
                    alert("Unable to delete");
                }
            );
        } else {
            return false;
        }
    };
});
