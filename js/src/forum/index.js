import Model from 'flarum/Model';
import IndexPage from 'flarum/components/IndexPage';

import addFederateFilters from './addFederateFilters';

app.initializers.add('flederation', function(app) {
   app.routes.federateDiscussions = {path: '/federate', component: IndexPage.component()};
   app.routes.localDiscussions = {path: '/local', component: IndexPage.component()};

   addFederateFilters();
});