# NextGenTrip

AI-first hotel extranet, automated onboarding, channel manager, CRS, revenue AI, analytics, support, and specialty travel platform.

## Repository

- Live remote: `https://github.com/srprogrammerashishgautam-alt/nextgentrip.git`
- Permanent local workspace: `D:\github\nextgentrip`
- Default branch: `main`

## Development Flow

1. Pull the latest `main`.
2. Create a focused feature branch for one module or phase.
3. Implement only the agreed scope for that module.
4. Add or update tests for the touched behavior.
5. Run the relevant checks locally.
6. Commit with a clear conventional commit message.
7. Push the branch to GitHub.
8. Open or update a pull request for review.

## SOW Phase Order

1. `P0` - Repository bootstrap and ground rules.
2. `P1` - Foundation, infrastructure, authentication, RBAC, queues, and admin shell.
3. `P2` - AI hotel acquisition and lead engine.
4. `P3` - Zero-touch hotel onboarding workflow.
5. `P4` - Property extranet and AI Copilot.
6. `P5` - Channel manager and CRS engine.
7. `P6` - Revenue management AI and PMS integration.
8. `P7` - Analytics, support AI, and specialty modules.
9. `P8` - Security, performance, and production readiness.

## Module Delivery Checklist

Before a module is considered complete:

- Scope matches the SOW and the current prompt only.
- External services are behind interfaces/adapters.
- Secrets are stored in environment variables only.
- Migrations are reversible and use UUIDs where required.
- Policies/authorization are covered.
- Service, API, and workflow tests are added.
- Documentation is updated for new commands, queues, events, or APIs.
- Git diff is reviewed before commit.

## GitHub Push Workflow

```powershell
git status
git checkout -b codex/phase-name
git add .
git commit -m "feat: phase name"
git push -u origin codex/phase-name
```

Use `chore:`, `feat:`, `fix:`, `docs:`, `test:`, and `refactor:` prefixes consistently.
