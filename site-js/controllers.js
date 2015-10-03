var siteControllers = angular.module('SiteControllers', []);

siteControllers.controller('SiteDataController', ['$scope', '$http', function($scope, $http) {

  $http.get('GetPortfolios.php').success(function(data) {
    $scope.portfolios = data;

  });

  $http.get('GetHomeData.php').success(function(data) {
    $scope.homeData = data;

  });

}]);

