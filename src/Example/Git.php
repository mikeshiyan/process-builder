<?php

namespace Shiyan\ProcessBuilder\Example;

use Shiyan\ProcessBuilder\BaseProcessBuilder;

/**
 * Git process builder.
 *
 * Main Porcelain Commands:
 * @method \Shiyan\ProcessBuilder\Process add(string ...$arguments) Add file contents to the index.
 * @method \Shiyan\ProcessBuilder\Process am(string ...$arguments) Apply a series of patches from a mailbox.
 * @method \Shiyan\ProcessBuilder\Process archive(string ...$arguments) Create an archive of files from a named tree.
 * @method \Shiyan\ProcessBuilder\Process bisect(string ...$arguments) Use binary search to find the commit that introduced a bug.
 * @method \Shiyan\ProcessBuilder\Process branch(string ...$arguments) List, create, or delete branches.
 * @method \Shiyan\ProcessBuilder\Process bundle(string ...$arguments) Move objects and refs by archive.
 * @method \Shiyan\ProcessBuilder\Process checkout(string ...$arguments) Switch branches or restore working tree files.
 * @method \Shiyan\ProcessBuilder\Process cherryPick(string ...$arguments) Apply the changes introduced by some existing commits.
 * @method \Shiyan\ProcessBuilder\Process citool(string ...$arguments) Graphical alternative to git-commit.
 * @method \Shiyan\ProcessBuilder\Process clean(string ...$arguments) Remove untracked files from the working tree.
 * @method \Shiyan\ProcessBuilder\Process clone(string ...$arguments) Clone a repository into a new directory.
 * @method \Shiyan\ProcessBuilder\Process commit(string ...$arguments) Record changes to the repository.
 * @method \Shiyan\ProcessBuilder\Process describe(string ...$arguments) Give an object a human readable name based on an available ref.
 * @method \Shiyan\ProcessBuilder\Process diff(string ...$arguments) Show changes between commits, commit and working tree, etc.
 * @method \Shiyan\ProcessBuilder\Process fetch(string ...$arguments) Download objects and refs from another repository.
 * @method \Shiyan\ProcessBuilder\Process formatPatch(string ...$arguments) Prepare patches for e-mail submission.
 * @method \Shiyan\ProcessBuilder\Process gc(string ...$arguments) Cleanup unnecessary files and optimize the local repository.
 * @method \Shiyan\ProcessBuilder\Process gitk(string ...$arguments) The Git repository browser.
 * @method \Shiyan\ProcessBuilder\Process grep(string ...$arguments) Print lines matching a pattern.
 * @method \Shiyan\ProcessBuilder\Process gui(string ...$arguments) A portable graphical interface to Git.
 * @method \Shiyan\ProcessBuilder\Process init(string ...$arguments) Create an empty Git repository or reinitialize an existing one.
 * @method \Shiyan\ProcessBuilder\Process log(string ...$arguments) Show commit logs.
 * @method \Shiyan\ProcessBuilder\Process merge(string ...$arguments) Join two or more development histories together.
 * @method \Shiyan\ProcessBuilder\Process mv(string ...$arguments) Move or rename a file, a directory, or a symlink.
 * @method \Shiyan\ProcessBuilder\Process notes(string ...$arguments) Add or inspect object notes.
 * @method \Shiyan\ProcessBuilder\Process pull(string ...$arguments) Fetch from and integrate with another repository or a local branch.
 * @method \Shiyan\ProcessBuilder\Process push(string ...$arguments) Update remote refs along with associated objects.
 * @method \Shiyan\ProcessBuilder\Process rangeDiff(string ...$arguments) Compare two commit ranges (e.g. two versions of a branch).
 * @method \Shiyan\ProcessBuilder\Process rebase(string ...$arguments) Reapply commits on top of another base tip.
 * @method \Shiyan\ProcessBuilder\Process reset(string ...$arguments) Reset current HEAD to the specified state.
 * @method \Shiyan\ProcessBuilder\Process revert(string ...$arguments) Revert some existing commits.
 * @method \Shiyan\ProcessBuilder\Process rm(string ...$arguments) Remove files from the working tree and from the index.
 * @method \Shiyan\ProcessBuilder\Process shortlog(string ...$arguments) Summarize 'git log' output.
 * @method \Shiyan\ProcessBuilder\Process show(string ...$arguments) Show various types of objects.
 * @method \Shiyan\ProcessBuilder\Process stash(string ...$arguments) Stash the changes in a dirty working directory away.
 * @method \Shiyan\ProcessBuilder\Process status(string ...$arguments) Show the working tree status.
 * @method \Shiyan\ProcessBuilder\Process submodule(string ...$arguments) Initialize, update or inspect submodules.
 * @method \Shiyan\ProcessBuilder\Process tag(string ...$arguments) Create, list, delete or verify a tag object signed with GPG.
 * @method \Shiyan\ProcessBuilder\Process worktree(string ...$arguments) Manage multiple working trees.
 *
 * Ancillary Commands / Manipulators:
 * @method \Shiyan\ProcessBuilder\Process config(string ...$arguments) Get and set repository or global options.
 * @method \Shiyan\ProcessBuilder\Process fastExport(string ...$arguments) Git data exporter.
 * @method \Shiyan\ProcessBuilder\Process fastImport(string ...$arguments) Backend for fast Git data importers.
 * @method \Shiyan\ProcessBuilder\Process filterBranch(string ...$arguments) Rewrite branches.
 * @method \Shiyan\ProcessBuilder\Process mergetool(string ...$arguments) Run merge conflict resolution tools to resolve merge conflicts.
 * @method \Shiyan\ProcessBuilder\Process packRefs(string ...$arguments) Pack heads and tags for efficient repository access.
 * @method \Shiyan\ProcessBuilder\Process prune(string ...$arguments) Prune all unreachable objects from the object database.
 * @method \Shiyan\ProcessBuilder\Process reflog(string ...$arguments) Manage reflog information.
 * @method \Shiyan\ProcessBuilder\Process remote(string ...$arguments) Manage set of tracked repositories.
 * @method \Shiyan\ProcessBuilder\Process repack(string ...$arguments) Pack unpacked objects in a repository.
 * @method \Shiyan\ProcessBuilder\Process replace(string ...$arguments) Create, list, delete refs to replace objects.
 *
 * Ancillary Commands / Interrogators:
 * @method \Shiyan\ProcessBuilder\Process annotate(string ...$arguments) Annotate file lines with commit information.
 * @method \Shiyan\ProcessBuilder\Process blame(string ...$arguments) Show what revision and author last modified each line of a file.
 * @method \Shiyan\ProcessBuilder\Process countObjects(string ...$arguments) Count unpacked number of objects and their disk consumption.
 * @method \Shiyan\ProcessBuilder\Process difftool(string ...$arguments) Show changes using common diff tools.
 * @method \Shiyan\ProcessBuilder\Process fsck(string ...$arguments) Verifies the connectivity and validity of the objects in the database.
 * @method \Shiyan\ProcessBuilder\Process gitweb(string ...$arguments) Git web interface (web frontend to Git repositories).
 * @method \Shiyan\ProcessBuilder\Process help(string ...$arguments) Display help information about Git.
 * @method \Shiyan\ProcessBuilder\Process instaweb(string ...$arguments) Instantly browse your working repository in gitweb.
 * @method \Shiyan\ProcessBuilder\Process mergeTree(string ...$arguments) Show three-way merge without touching index.
 * @method \Shiyan\ProcessBuilder\Process rerere(string ...$arguments) Reuse recorded resolution of conflicted merges.
 * @method \Shiyan\ProcessBuilder\Process showBranch(string ...$arguments) Show branches and their commits.
 * @method \Shiyan\ProcessBuilder\Process verifyCommit(string ...$arguments) Check the GPG signature of commits.
 * @method \Shiyan\ProcessBuilder\Process verifyTag(string ...$arguments) Check the GPG signature of tags.
 * @method \Shiyan\ProcessBuilder\Process whatchanged(string ...$arguments) Show logs with difference each commit introduces.
 */
class Git extends BaseProcessBuilder {}
