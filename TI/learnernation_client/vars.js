var config = require('./config');

// Set local vars
// Not accessible in middleware.  Must copy to res.locals
module.exports = {
   all : function(app){
      app.locals.env = {
    		"isServerHost": config.isServerHost
    	, "tag": config.configTag
    	, "node": config.nodeEnv
      },
      app.locals.meta = {
        "description" : "Impactly measures your company’s performance against industry KPIs and suggests training for your team members – to impact your revenues."
      , "keywords" : "KPI, professional education, employee training, ImpactScore, Business development, team performance, measure effectiveness, impactly, e-learning, revenue growth"
      , "title" : "Impactly – Measure. Train. Impact."
      }
   }
}
