### DO NOT PUSH TO 'MASTER'. USE MERGE REQUESTS. ###
### DO NOT PUSH TO 'DEVELOP'. USE MERGES. ###
From [Working with Git remote repos worksheet](https://github.com/covcom/205CDE/blob/master/labs/02%20Git%20Remotes/worksheet.md).

> ## Merge Requests ##
> If you are working as part of a team you will each be working on code in your own branch(es). Before merging a branch back into the master you should issue a merge request. You detail the branch you want to merge, where you want to merge it and the features you have added. Others can view the changes you intend making to the master branch and suggest changes. When working in a team you will be expected to use this tool before merging any branches.

## List of Wiki Pages ##
1. **[Codio Box Configuration](https://gitlab.com/joseu/R2Projekti/wikis/codio-box-configuration)**
1. [Git Configuration](https://gitlab.com/joseu/R2Projekti/wikis/git-configuration)
1. [Installing MySQL](https://gitlab.com/joseu/R2Projekti/wikis/installing-mysql)
1. [Using Git](https://gitlab.com/joseu/R2Projekti/wikis/using-git)
1. [API Documentation](https://gitlab.com/joseu/R2Projekti/wikis/api-documentation)

## Git Branches ##
* Make a **new branch** for each **new feature**.
* Make a **new branch** for **fixing bugs**.
* Any branches other than `master` and `develop` can be deleted after they have been **merged** with the `develop` branch.

### 'master' branch ##
* The latest fully functional **release**.
* Should have no bugs or outstanding **Issues**.
* Never delete the branch.
* Never `git push` to the branch.
* Never `git commit` in the branch.
* Never write code or modify files in the branch.

### 'develop' branch ###
* The latest development version of the application.
* Never delete the branch.
* You can `git push` to the branch after **merges**.
* Never `git commit` in the branch.
* Never write code or modify files in the branch.

# How to Develop a New Feature #
* Development is always done in separate branches.
* **NEVER WRITE, COMMIT, OR PUSH CODE WHILE IN `master` BRANCH.**
* **NEVER WRITE, COMMIT, OR PUSH CODE WHILE IN `develop` BRANCH.**
* Check your current branch with `git status`.

## How to Create a New Local Branch for Development ##
1. Switch to the `develop` branch: `git checkout develop`
1. Pull the latest changes: `git pull origin develop`
1. Make a new branch on your local repository from the current branch (which is the `develop` branch): `git checkout -b mynewfeature`
1. Your local repository is now on the `mynewfeature` branch and the contents are identical to the `develop` branch. Doing this did not do anything on the remote repository in GitLab.

## How to Write & Commit Code ##
Do your best to separate the **client** (browser/user) code and **server** (running on the Codio box) code.
* **Client** code is written in HTML, CSS, and **JavaScript**.
    * Most/All dynamic content that changes often (views) is client code.
* **Server** code is written in **PHP**.
    * Most/All static content (models, controllers) is server code.

Repeat the following steps as many time as needed:

1. Write your code.
1. Test your code.
1. Make sure your code works and has no bugs.
1. Go to the root folder of the project `r2projekti` and stage your changes: `git add .`
1. Commit with descriptive messages: `git commit -m 'Added email field to registration page'`

If you want assistance with your code from other group members:

1. Push your local branch into GitLab. Make absolutely sure that you are using the same branch name as the one you created before. Use `git status` to see what branch you are on. Push your commits to GitLab: `git push origin mynewfeature`
1. When you do this the first time, Git creates a new branch in the remote repository in GitLab and your `mynewfeature` branch will be visible there.
1. Other people can now access your branch from GitLab with: `git checkout mynewfeature`

## How to Merge to 'develop' Branch ##
* You will never write code directly in the `develop` branch.
* You do not `git commit` in the `develop` branch.
* You only `git merge` other branches to it and `git push` those changes to the remote repository in GitLab.

Once the new feature is complete make sure you have committed any changes you've made and your working directory is clean. Check this with the `git status` command. You are now ready to **merge** your branch `mynewfeature` with the `develop` branch.

1. Switch your local repository to the `develop` branch: `git checkout develop`
1. Pull the latest changes: `git pull origin develop`
1. Merge your `mynewfeature` branch to the current branch (which is the `develop` branch) : `git merge mynewfeature`
1. Sometimes you get a merge conflict, sometimes you don't. I'll write about those later.
1. Merging does not change the remote repository. In fact if you check the status of your local repository with `git status` there are no changes or commits. You just need to know to always push after merges. Push the merge to GitLab: `git push origin develop`
1. Delete the old development branch because it should not be used anymore: `git branch -d mynewfeature`
1. Repeat from **How to Create a New Branch for Development**.

# How to Merge to 'master' Branch #
* You will never write `git push origin master`.
* You only use **Merge Requests** on the left toolbar to **merge** changes into the `master` branch using **GitLab**.
* You only merge changes from the `develop` branch to `master`. Not from anywhere else.

## When to Merge to 'master' Branch ##
When the `develop` branch is in a state where it could be used by the public. It is bug free and has no incomplete features. In other words it would be ready for release. In our small project this probably does not change very often.

## Merging 'develop' branch to 'master' branch ##
1. Verify that the current `develop` branch is bug free and works as intended.
1. Go to **GitLab** and open the Merge Requests page.
1. Press the green **+ NEW MERGE REQUEST** button.
1. In the **Source branch** box select the `develop` branch.
1. In the **Target branch** box select the `master` branch.
1. The **title** is fairly irrelevant.
1. Write a **description** of what changes have been done to the `develop` branch since the last Merge Request with `master`.
1. No need to assign the Merge Request to anyone.
1. Assign the Merge Request to a **Milestone** if relevant.
1. Add a relevant **Label**. If there are no relevant labels, do not add anything.
1. Press **SUBMIT MERGE REQUEST**.
1. Wait for some other group member to go over the changes, test them and accept the Merge Request.