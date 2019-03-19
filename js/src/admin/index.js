import { extend } from 'flarum/extend';

import FeddlePage from './components/FeddlePage';

import AdminNav from 'flarum/components/AdminNav';
import AdminLinkButton from 'flarum/components/AdminLinkButton';

app.initializers.add('feddle', app => {

  app.routes.feddle = {path: '/feddle', component: FeddlePage.component()};

  app.extensionSettings['flarum-feddle'] = () => m.route(app.route('feddle'));

  extend(AdminNav.prototype, 'items', (items) => {
    items.add('feddle', AdminLinkButton.component({
      href: app.route('feddle'),
      icon: 'far fa-chart-bar',
      children: 'feddle',
      description: 'feddle'
    }));
  });
});