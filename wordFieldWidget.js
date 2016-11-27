'use strict';
angular.module('word.field.widget')
    .controller('wordFieldWidgetController', ['$scope', function($scope) {
        $scope.insertdata = function(){
            console.log("insertdata");
            $http.post("insert.php", {'typedValue': $scope.name,'blabla': 'BBBBB' })//$scope.name
                .success(function(data, status, headers, config){
                    console.log("data saved");
                });
        };
        $scope.readdata = function(){
            console.log("readdata");
            $http.post("read.php", {'typedValue': $scope.name,'blabla': 'BBBBB' })//$scope.name
                .success(function(data, status, headers, config){
                    console.log("data read");
                });
        };
    }])
    // .directive('wordFieldWidget', function() {
    //     return {
    //         templateUrl: 'word-field-widget.html',
    //         controller: 'wordFieldWidgetController'
    //     };
    // })
;
