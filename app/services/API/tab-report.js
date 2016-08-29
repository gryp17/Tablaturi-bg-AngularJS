app.factory('TabReportService', function($http) {
	return {
		reportTab: function(tabId, report) {
			return $http({
				method: 'POST',
				url: 'TabReport/reportTab',
				data: {
					tab_id: tabId,
					report: report
				}
			});
		}
	};
});