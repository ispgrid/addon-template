# ISPGrid add-on template

A small, working [ISPGrid](https://github.com/ispgrid/ispgrid) add-on to start yours from: one page in the Add-ons
menu, one setting on System, then Add-ons, two permission boxes, Hindi strings, tests and CI.

The full guide to writing an add-on, and getting it into the ISPGrid add-on list, is in
[ispgrid/addons](https://github.com/ispgrid/addons/blob/master/docs/creating-an-addon.md).

## Start

1. On GitHub, **Use this template**, then **Create a new repository**. Name it like your package: the server installs
   `vendor/package` from `https://github.com/vendor/package`, so the repository must be `package` under your
   account or organisation `vendor`.
2. Rename everything that says hello. With `vendor/package` = `yourname/billing`:

   | Replace | With |
   |---|---|
   | `acme/hello` | `yourname/billing` (composer.json, the provider, `.github/workflows/ci.yml`, tests) |
   | `Acme\Hello` and `Acme\\Hello` | `Yourname\Billing` (namespace) |
   | `HelloServiceProvider` | `BillingServiceProvider` (class and file name) |
   | `hello::`, `'hello'` namespace, `hello.` setting keys, `hello.index` route | `billing` |
   | `view-hello`, `manage-hello` | your own permission names (provider, migration, views, tests) |
   | `Hello` in strings and `lang/hi.json` | your add-on's name |

   Then rename the migration file and set `name`, `description` and `authors` in composer.json, and the copyright
   line in LICENSE.
3. Read the [guide](https://github.com/ispgrid/addons/blob/master/docs/creating-an-addon.md) before adding features:
   what core lets an add-on use, and what the review refuses.

## Develop

In an ISPGrid checkout next to this repository:

```bash
cp composer.json composer.lock ../addon-backup/      # restore them when you are done
composer config repositories.my-addon '{"type": "path", "url": "../billing", "options": {"symlink": true}}'
composer require yourname/billing:@dev
ISPGRID_ADDONS=on php vendor/bin/pest --test-directory=vendor/yourname/billing/tests vendor/yourname/billing/tests
vendor/bin/pint ../billing/src ../billing/database ../billing/routes ../billing/tests ../billing/resources
```

Never commit the checkout's changed `composer.json` and `composer.lock`.

## License

MIT
