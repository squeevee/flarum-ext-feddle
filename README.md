# Feddle

(Experimental) Fediverse integration for Flarum: joins your forum to a growing network of federated social media platforms including Mastodon, Plemora, and Friendica.

## Overview

A federated social network is one comprised of multiple decentralized and independent websites/servers ("instances"), which communciate among each other to form a cohesive body of content, activity, and user identities. A user with an account on one instance in such a network should be able to interact with users throughout the whole network as though it were one site. Many federated social network projects exist, and (to varying amounts) are intercompatible, together comprising what is sometimes called the "Fediverse."

Feddle (federation extension for Flarum) aims to integrate participating Flarum instances into the Fediverse. Forum discussions have a lot in common with other kinds of social media posting, while also bringing unique value to the table. There's potentially a lot to be gained from federation for Flarum and for the rest of the Fediverse.

## Installation Instructions

Pending, probably until a proper alpha release (which this is not). If you're trying to install Feddle at this point that means you're a developer and I have confidence in your ability to make it work.

Participation in backend code on this project should probably also involve helping out with our main dependency: the Pterotype Project's ActivityPub-PHP library.

It may also be a good idea to install a local dev instance of Mastodon -- or another ActivityPub project -- for testing. If you're not too picky, you can get away with skipping a lot of the Mastodon installation instructions.

## Short term trajectory

Get Mastodon to recognize one of our user Actors. Recognize one of Mastodon's. (Of all the Fediverse, we're gonna support Mastodon first)

After that we work on reading outboxes, then posting to inboxes.

Somewhere early on we'll want to get WebFinger working.