## Contributing to FRMFM API

Thanks for your interest in contributing to FRMFM!

## Stuff You Can Do

- **Report bugs.** If you find a bug, we'd like to know about it. Work out which GitHub repository the bug report belongs to (i.e. [an extension repository](https://github.com/frmfm/api) vs. [the core repository](https://github.com/frmfm/api) and then give us as much information as you can. Thanks!


- **Contribute code.** Take a look at the [issue list](https://github.com/frmfm/api/issues) and see if there's anything you can help out with. See below for instructions on submitting a Pull Request.


## Pull Requests

1. Review the [Contributor License Agreement](#contributor-license-agreement).

2. Create a new branch.

  ```sh
  git checkout -b new-branch
  ```

  > Please implement only one feature/bugfix per branch to keep pull requests clean and focused.

3. Code.
  - Follow the coding style: [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
 

4. Commit.
  - Commit messages are **required**.
  - They should include a short description of the changes on the first line, then a blank line, then more details if necessary.

5. Clean up. Squash together minor commits.

  ```sh
  git rebase -i
  ```

6. Update your branch so that it is based on top of the latest code from the Phanbook repository.

  ```sh
  git fetch origin
  git rebase origin/master
  ```

7. Submit a pull request.
  - Click "Pull Request".
  - Write your branch name in the branch field.
  - Click "Update Commit Range".
  - Ensure that the correct commits and files changes are included.
  - Fill in a descriptive title and other details about your pull request.
  - Click "Send pull request".

8. Respond to feedback.
  - We may suggest changes to your code. Maintaining a high standard of code quality is important for the longevity of this project — use it as an opportunity to improve your own skills and learn something new!

## Contributor License Agreement