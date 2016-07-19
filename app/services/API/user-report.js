app.factory('UserReportService', function($http) {
	return {
		reportUser: function(userId, report) {
			return $http({
				method: 'POST',
				url: 'UserReport/reportUser',
				data: {
					user_id: userId,
					report: report
				}
			});
		}
	};
});