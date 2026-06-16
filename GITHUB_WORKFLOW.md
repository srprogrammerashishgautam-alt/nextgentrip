# GitHub Push Workflow

Live repository:

```text
https://github.com/srprogrammerashishgautam-alt/nextgentrip.git
```

Permanent local workspace:

```text
D:\github\nextgentrip
```

## First-Time Remote Check

```powershell
git remote -v
```

Expected:

```text
origin  https://github.com/srprogrammerashishgautam-alt/nextgentrip.git (fetch)
origin  https://github.com/srprogrammerashishgautam-alt/nextgentrip.git (push)
```

## Per-Module Workflow

```powershell
git status
git switch main
git pull origin main
git switch -c codex/phase-or-module-name
```

After implementation:

```powershell
git status
git add .
git commit -m "feat: phase or module name"
git push -u origin codex/phase-or-module-name
```

## Direct Main Push

Only use direct main pushes when explicitly approved:

```powershell
git switch main
git pull origin main
git add .
git commit -m "chore: prepare nextgentrip repository workspace"
git push origin main
```

## Pull Request Notes

Each PR should include:

- Scope completed.
- Files or modules changed.
- Tests/checks run.
- External services mocked or pending credentials.
- Known follow-up work.
