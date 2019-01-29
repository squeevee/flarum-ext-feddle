import { extend } from 'flarum/extend';
import IndexPage from 'flarum/components/IndexPage';
import LinkButton from 'flarum/components/LinkButton';

export default function() {
    //todo: user must be logged in
    extend(IndexPage.prototype, 'navItems', function(items) {
        items.add('federateDiscussions', LinkButton.component({
          icon: 'fas fa-globe',
          children: app.translator.trans('squeevee-feddle.forum.buttons.federate-discussions'),
          href: app.route('federateDiscussions')
        }), 99);

        items.add('localDiscussions', LinkButton.component({
            icon: 'fas fa-home',
            children: app.translator.trans('squeevee-feddle.forum.buttons.local-discussions'),
            href: app.route('localDiscussions')
          }), 98);
    });
}