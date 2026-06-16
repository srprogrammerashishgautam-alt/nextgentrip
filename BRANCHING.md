# Branch Naming Rules

Use short, descriptive branch names that identify the module or phase.

## Preferred Patterns

- `codex/phase-1-foundation`
- `codex/phase-2-acquisition`
- `codex/phase-3-onboarding`
- `codex/module-channel-manager`
- `codex/fix-auth-refresh-token`
- `codex/docs-api-reference`

## Rules

- Use lowercase letters, numbers, and hyphens.
- Prefix Codex-authored work with `codex/`.
- Keep one phase, module, or fix per branch.
- Do not mix unrelated refactors with feature delivery.
- Rebase or merge latest `main` before pushing major module work.

## Commit Message Format

Use conventional commit prefixes:

- `chore:` setup, tooling, maintenance
- `docs:` documentation-only changes
- `feat:` new product behavior
- `fix:` bug fixes
- `test:` test-only changes
- `refactor:` internal code restructuring without behavior changes

Example:

```text
feat: phase 2 acquisition lead engine
```
