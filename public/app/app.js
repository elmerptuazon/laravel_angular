var app = angular
    .module("customerRecords", [], function($interpolateProvider) {
        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");
    })
    .constant("API_URL", "http://localhost:8000/");
