# Deployments
## Create a commit for the changes
Use `git status` to see the status of the the local repository and `git add *` to stage all of the files for committing.
Use `git commit -m` to commit the staged files.
```bash
git commit -m "1.1.0 update"
```

## Create a tag for the new version
Use `git tag -a` to add an annotated tag to the latest commit.
```bash
git tag -a v1.1.0 HEAD -m "Version 1.1.0"
```
Use `git tag` to view a list of all tags.

## Push the changes to the remote branch
Add the tag name to the end to also push the tag with commit
```bash
git push origin v1.1.0
```
Alternatively, you can use `git push origin --tags` to push all tags to remote.

## Create the pull request on Github and merge
Add a message to the pull requests that explains all of the changes. When merged, check the releases to make sure that the new version number has been added.
