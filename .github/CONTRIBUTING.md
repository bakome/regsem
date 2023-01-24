# How to contribute

It is essential to the development of RegSem that the community is empowered
to make changes and get them into the library. Here are some guidelines to make
that process silky smooth for all involved.

## Reporting issues

To report a bug, request a feature, or even ask a question, make use of the GitHub Issues
section for RegSem Issues. When submitting an issue please take the following steps:

1. **Seach for existing issues.** Your question or bug may have already been answered or fixed,
be sure to search the issues first before putting in a duplicate issue.

2. **Create an isolated and reproducible test case.** If you are reporting a bug, make sure you
also have a minimal, runnable, code example that reproduces the problem you have.

3. **Include a live example.** After narrowing your code down to only the problem areas, make use of online compiler, or a link to your live site so that we can view a live example of the problem.

4. **Share as much information as possible.** Include browser version affected, your OS, version of
the library, steps to reproduce, etc. "X isn't working!!!1!" will probably just be closed.

## Contributing Changes

### Setting Up

To setup for making changes you will need to take a few steps, we've outlined them below:

1. Ensure you have php >= 8 installed.

2. Fork the RegSem repository.

3. Next, run `composer install` from within your clone of your fork. That will install dependencies
necessary to build RegSem.


### Making a Change

Once you have php, the repository, and have installed dependencies are you almost ready to make your
change. The only other thing before you start is to checkout the correct branch. Which branch you should
make your change to (and send a PR to) depends on the type of change you are making.

Here is our branch breakdown:

- `main` - Always avoid for direct change.
- `develop` - Make change to `develop` if it is a feature, bugfix or a backwards-compatible feature.

Your change should be made directly to the branch in your fork, or to a branch in your fork made off of
one of the above branches.

### Testing Your Change

You can test your change by using the automated tests. You can run these tests
by running `composer run test` from the command line. Please provide tests for every bug or feature.

### Submitting Your Change

After you have made and tested your change, commit and push it to your fork. Then, open a Pull Request
from your fork to the main repository on the branch you used in the `Making a Change` section of this document.

## Quickie Code Style Guide

- Use 4 spaces for tabs, never tab characters.
- No trailing whitespace, blank lines should have no whitespace.
- Always favor strict equals `===` unless you *need* to use type coercion.
- Follow conventions already in the code.