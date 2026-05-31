var env = process.env.NODE_ENV || "production";
var environments = {
	"development": {
		"isServerHost": "https://staging-server.impactly.com",
		"tag": "dev"
	},

	"local": {
		"isServerHost": "http://localhost:3001",
		"tag": "loc"
	},

	"production": {
		// http://impactscore-server.cloudapp.net"
		"isServerHost": "https://server.impactly.com",
		"tag": "prd"
	},

	"production-azure": {
		"isServerHost": "https://server.impactly.com",
		"tag": "azr"
	},

	"demo-azure": {
		"isServerHost": "http://server.impactly.com",
		"tag": "dmo"
	},

	"staging-azure": {
		"isServerHost": "https://staging-server.impactly.com",
		"tag": "stg"
	},
};

exports.nodeEnv = env;
exports.configTag = environments[env]["tag"];
exports.isServerHost = environments[env]["isServerHost"];
